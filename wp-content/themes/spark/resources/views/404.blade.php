{{-- Redirect 404 to Dashboard --}}

@php
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: " . home_url('dashboard'));
  exit;
@endphp
