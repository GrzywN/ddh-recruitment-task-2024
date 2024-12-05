<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles / Scripts -->
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
        >
    </head>
    <body>
        <dialog open>
          <article>
            <header>
              <p>
                <strong>Zgłoszenie zostało wysłane</strong>
              </p>
            </header>

            <p>
                Dziękujemy za przesłanie zgłoszenia. Nasz zespół skontaktuje się z Tobą w ciągu 48 godzin.
            </p>
          </article>
        </dialog>
    </body>
</html>

