{{ noparse }}
Just hit `/TRIGGER/api/call` with POST or GET vars (POST takes precedence) set for the class, method,
and args. Make sure your args are assigned in the right order.

For example, `/TRIGGER/api/call?class=File&method=exists&files=index.php` will call
`File::exists('index.php')` and should return `true`.
{{ /noparse }}
