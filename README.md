http://localhost:8080/ -> Tự động load Trang chủ.

http://localhost:8080/index.php?page=products -> Load Trang sản phẩm.

http://localhost:8080/index.php?page=abcxyz -> Load Trang 404.



├── 404.php
|
├── home.php
|
├── about.php
|
├── ... (các file trang chủ)
|
└── admin/
    |
    └── ui/
    |    ├── index.php          (File chứa các CTA dẫn đến các edit)
    |    |
    |    ├── home.php          (File edit trang chủ) (nếu mà router động được thì tốt)
    |    |
    |    ├── about.php         (File edit trang about) (nếu mà router động được thì tốt)
    |    |
    |    ├── ...     (File edit services, contact, policy, 404, layout,...) (nếu mà router động được thì tốt)
    |
    |
    |
    └── templates/
        |
        ├── index.php          (File chứa các CTA dẫn đến các edit)
        |
        ├── ....php         (File edit các templates) (nếu mà router động được thì tốt)

  