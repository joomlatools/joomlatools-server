---
# Sentry.io integration
#
# Supports:
#
# - Error Tracking
# - Performance Tracing
#
# For more info see: https://docs.sentry.io/platforms/javascript/

dsn:
tags: []
tracesSampleRate: 1.0
---

<? $dsn = $dsn ?? getenv('SENTRY_DSN') ?>

<? if (!empty($dsn)): ?>
    <script src="https://browser.sentry-cdn.com/6.15.0/bundle.tracing.min.js" integrity="sha384-uAr9Te+rNkmpaCjPTu4/ipQDpO1nR6fEY8JX+NHVNO5mY6LUs362JWJD8rHyaLEt" crossorigin="anonymous" ></script>
    <script>
        Sentry.init({
            dsn: "<?= $dsn ?>",
            debug: <?= debug() ?>,
            environment: "<?= getenv('SENTRY_ENVIRONMENT') ?: getenv('APP_ENV') ?>",
            tracesSampleRate: <?= $tracesSampleRate ?? 1.0 ?>,
            integrations: [new Sentry.Integrations.BrowserTracing()],
            initialScope: scope => {
                <?
                if(getenv('FLY_REGION')) {
                    $tags['fly.region'] = getenv('FLY_REGION');
                }

                if(getenv('FLY_APP_NAME')) {
                    $tags['fly.app_name'] = getenv('FLY_APP_NAME');
                }

                if(getenv('FLY_ALLOC_ID')) {
                    $tags['fly.alloc_id'] = getenv('FLY_ALLOC_ID');
                }
                ?>

                scope.setTags(<?= json($tags) ?>);
                return scope;
            },
        });
    </script>
<? endif; ?>