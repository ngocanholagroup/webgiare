<?php
/**
 * Validator - Input validation and sanitization layer
 * Hỗ trợ các loại validation phổ biến
 */

class Validator {
    private $errors = [];
    private $data = [];

    public function __construct($data = []) {
        $this->data = $data;
    }

    /**
     * Validate với rules định sẵn
     * Rules format: 'field' => 'required|string|max:100|email'
     */
    public function validate($rules) {
        $this->errors = [];

        foreach ($rules as $field => $ruleString) {
            $fieldRules = explode('|', $ruleString);
            $value = $this->data[$field] ?? null;

            foreach ($fieldRules as $rule) {
                $this->applyRule($field, $value, $rule);
                if (!empty($this->errors[$field])) {
                    break; // Dừng kiểm tra nếu đã có lỗi
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * Apply single validation rule
     */
    private function applyRule($field, $value, $rule) {
        // Parse rule: "max:100" -> ['max', '100']
        $parts = explode(':', $rule);
        $ruleName = $parts[0];
        $ruleParam = $parts[1] ?? null;

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, "{$field} là bắt buộc.");
                }
                break;

            case 'string':
                if ($value !== null && !is_string($value)) {
                    $this->addError($field, "{$field} phải là chuỗi ký tự.");
                }
                break;

            case 'email':
                if ($value !== null && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "{$field} không phải email hợp lệ.");
                }
                break;

            case 'min':
                if ($value !== null && strlen($value) < (int)$ruleParam) {
                    $this->addError($field, "{$field} phải có ít nhất {$ruleParam} ký tự.");
                }
                break;

            case 'max':
                if ($value !== null && strlen($value) > (int)$ruleParam) {
                    $this->addError($field, "{$field} tối đa {$ruleParam} ký tự.");
                }
                break;

            case 'numeric':
                if ($value !== null && !is_numeric($value)) {
                    $this->addError($field, "{$field} phải là số.");
                }
                break;

            case 'integer':
                if ($value !== null && !is_int($value) && !ctype_digit((string)$value)) {
                    $this->addError($field, "{$field} phải là số nguyên.");
                }
                break;

            case 'phone':
                if ($value !== null && !preg_match('/^0\d{9,10}$/', $value)) {
                    $this->addError($field, "{$field} không phải số điện thoại hợp lệ.");
                }
                break;

            case 'url':
                if ($value !== null && !filter_var($value, FILTER_VALIDATE_URL)) {
                    $this->addError($field, "{$field} không phải URL hợp lệ.");
                }
                break;

            case 'date':
                if ($value !== null && !$this->isValidDate($value)) {
                    $this->addError($field, "{$field} không phải ngày hợp lệ (Y-m-d).");
                }
                break;

            case 'unique':
                // ruleParam = table:column
                if ($value !== null && $this->isDuplicate($ruleParam, $value)) {
                    $this->addError($field, "{$field} đã tồn tại trong hệ thống.");
                }
                break;

            case 'regex':
                if ($value !== null && !preg_match($ruleParam, $value)) {
                    $this->addError($field, "{$field} không đúng định dạng.");
                }
                break;

            case 'array':
                if ($value !== null && !is_array($value)) {
                    $this->addError($field, "{$field} phải là mảng.");
                }
                break;

            case 'in':
                // in:option1,option2,option3
                $options = explode(',', $ruleParam);
                if ($value !== null && !in_array($value, $options)) {
                    $this->addError($field, "{$field} giá trị không hợp lệ.");
                }
                break;
        }
    }

    /**
     * Sanitize input data
     */
    public static function sanitize($data, $rules = []) {
        $sanitized = [];

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $sanitized[$key] = self::sanitizeValue($value, $rules[$key] ?? 'string');
            }
        }

        return $sanitized;
    }

    /**
     * Sanitize single value
     */
    private static function sanitizeValue($value, $type = 'string') {
        if ($value === null) {
            return null;
        }

        if ($type === 'email') {
            return filter_var($value, FILTER_SANITIZE_EMAIL);
        } elseif ($type === 'url') {
            return filter_var($value, FILTER_SANITIZE_URL);
        } elseif ($type === 'integer') {
            return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        } elseif ($type === 'float') {
            return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        } else {
            // Default: HTML escape
            return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
        }
    }

    /**
     * Get all errors
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Get error for specific field
     */
    public function getError($field) {
        return $this->errors[$field] ?? null;
    }

    /**
     * Add error manually
     */
    private function addError($field, $message) {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = $message;
        }
    }

    /**
     * Check if date is valid (Y-m-d format)
     */
    private function isValidDate($date) {
        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    /**
     * Check if value already exists in database
     */
    private function isDuplicate($tableColumn, $value) {
        list($table, $column) = explode(':', $tableColumn);
        
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) FROM {$table} WHERE {$column} = :value");
        $stmt->execute([':value' => $value]);
        
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Batch validation and sanitization
     */
    public static function validateAndSanitize($data, $rules) {
        $validator = new self($data);
        
        if (!$validator->validate($rules)) {
            return [
                'valid' => false,
                'errors' => $validator->getErrors(),
                'data' => null
            ];
        }

        return [
            'valid' => true,
            'errors' => [],
            'data' => self::sanitize($data, $rules)
        ];
    }
}
