@if(App::environment() === 'local')
    <pre>{{ json_encode(get_defined_vars()['__data'], JSON_PRETTY_PRINT) }}</pre>
@endif