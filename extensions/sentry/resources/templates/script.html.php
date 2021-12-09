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
version:
release:
tunnel:
tags: []
environment:
tracesSampleRate: 1.0
---

<?
$dsn = $dsn ?? getenv('SENTRY_DSN');
$env = $environment ?? getenv('SENTRY_ENVIRONMENT');
$rel = $release ?? getenv('SENTRY_RELEASE') ?: object('pages.version')->getVersion();

if(!empty($version)) {
    $version =  '@'.$version;
}

?>

<? if (!empty($dsn)): ?>
<script src="https://unpkg.com/@sentry/tracing<?= $version ?>/build/bundle.tracing.min.js" crossorigin="anonymous" ></script>
<script>
Sentry.init({
    dsn: "<?= $dsn ?>",
    debug: <?= debug() ? 'true' : 'false' ?>,
    tunnel: <?= !empty($tunnel) ? '"'.$tunnel.'"' : 'null' ?>,
    release: <?= !empty($rel) ? '"'.$rel.'"' : 'null' ?>,
    environment: <?= !empty($env) ? '"'.$env.'"' : 'null' ?>,
    tracesSampleRate: <?= $tracesSampleRate ?? 1.0 ?>,
    integrations: [new Sentry.Integrations.BrowserTracing()],
    initialScope: scope => {
        <?
        if(getenv('FLY_REGION')) {
            $tags['app.region'] = getenv('FLY_REGION');
        }

        if(getenv('FLY_ALLOC_ID')) {
            $tags['app.id'] =  hash('crc32b', getenv('FLY_ALLOC_ID'));
        }
        ?>

        scope.setTags(<?= json($tags) ?>);
        return scope;
    },
});
</script>
<? endif; ?>