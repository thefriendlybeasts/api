{{ noparse }}
# Usage
## Statamic API
Just hit `/TRIGGER/r2/statamic_api_call` with POST or GET vars (POST takes precedence) set for the
class, method, and args. Make sure your args are assigned in the right order.

For example, `/TRIGGER/r2/statamic_api_call?class=File&method=exists&files=index.php` will call
`File::exists('index.php')` and should return `true`.


## Statamic add-ons' APIs.
You can also call add-ons' API methods by hitting `/TRIGGER/r2/addon_api_call`. This method follows
the same rules as the Statamic API method, except in addition to the `class` key, you can also use:
`addon` or `add-on`.
{{ /noparse }}
