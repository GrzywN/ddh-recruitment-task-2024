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
                <strong>Dołącz do naszego zespołu!</strong>
              </p>
            </header>

            <p>
                Cieszymy się, że chcesz zostać częścią naszej firmy. Wypełnij poniższy formularz, a nasz zespół HR skontaktuje się z Tobą w ciągu 48 godzin.
            </p>

            <section>
                {!! $form !!}
            </section>
          </article>
        </dialog>
    </body>
</html>

