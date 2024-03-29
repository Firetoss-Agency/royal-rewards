<!doctype html>
<html class="no-js" {{ get_language_attributes() }}>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php wp_head() @endphp
    {{ the_field('header_script_snippets', 'option') }}
    @stack('head')
  </head>

  <body @php body_class(); @endphp {{ (is_archive('offers')) ? 'uk-filter=.offer-filter' : '' }}>
    {{ the_field('body_script_snippets', 'option') }}
    @stack('body')

    @if(!is_front_page())
      @include('global.nav')
    @endif

    <main class="site {{ main_class() }}" id="site-main" role="document">
      @yield('content')
    </main>

    @if(!is_front_page())
      @include('global.footer')
    @endif

    @php wp_footer() @endphp
    {{ the_field('footer_script_snippets', 'option') }}
    @stack('footer')
  </body>
</html>
