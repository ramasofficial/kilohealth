## Kilo Health Academy task

This is the solution for the admissions tasks for Kilo Health PHP Academy.

# Usage

Clone this repository, enter 'task' folder using Powershell or cmd.exe and run

```
php artisan serve
```

to run the Laravel server. Then open another Powershell and cmd.exe window, enter 'task/app' and run

```
php run.php count_by_price_range <price_from_float> <price_to_float>
```
to count offers belonging to the specified price range.

Or run
```
php run.php count_by_vendor_id <non_negative_integer>
```
to count offers from a vendor specified by vendor ID.

Or run
```
php run.php count_by_keyword <string_without_spaces>
```
to count offers with a specific keyword (substring) in the title.
