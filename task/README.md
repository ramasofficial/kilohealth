# Kilo Health Academy task

<p>This is the solution for the admissions tasks for Kilo Health PHP Academy.</p>
<p>The script collects product offer JSON data from a HTTP endpoint whose URL is specified inside the script. The app hosts a route at 'localhost:8000/api/json' which delivers a stock JSON response. A remote endpoint can be used by specifying its URL inside '/task/app/run.php'.</p>
<p>Using one of three command line parameters can either:</p> 
<li>count the offers belonging to a specified <b>price range</b>;</li>
<li>count offers of a specific vendor by giving a <b>vendor ID</b>;</li>
<li>count the offers whose titles contain a given <b>keyword</b>.</li>

## Usage

Clone this repository, enter 'task' folder using Powershell or cmd.exe and run

```
php artisan serve
```

to run the Laravel server. Then open another Powershell and cmd.exe window, enter '/task/app' and run

```
php run.php count_by_price_range <price_from_float> <price_to_float>
```
to count offers belonging to the specified price range,

or run
```
php run.php count_by_vendor_id <non_negative_integer>
```
to count offers from a vendor specified by vendor ID,

or run
```
php run.php count_by_keyword <string_without_spaces>
```
to count offers with a specific keyword (substring) in the title.

### Example output
![Example output screenshot](/task/example_screenshot.png)

## Tests

Enter 'task' directory and run
```
php artisan test
```
to run the unit tests for this app.

## Logging

Logging can be enabled/disabled by setting the `$do_logging` variable inside '/task/app/run.php' to `true`/`false`.
