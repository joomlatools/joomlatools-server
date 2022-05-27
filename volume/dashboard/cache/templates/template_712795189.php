<?php /**
 * Joomlatools Pages
 *
 * @copyright   Copyright (C) 2018 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/joomlatools/joomlatools-pages for the canonical source repository
 */

?>

<!DOCTYPE html>
<html xmlns:og="http://opengraphprotocol.org/schema/" class="no-js" lang="<?php echo $this->language() ?>" dir="<?php echo $this->direction() ?>" vocab="http://schema.org/">
<head>
    <meta charset="utf-8"/>
    <base href="<?php echo $this->url()->toString(KHttpUrl::FULL ^ KHttpUrl::SCHEME); ?>" />

    <ktml:title>
    <ktml:meta>
    <ktml:link>
    <ktml:style>
    <ktml:script>

    <title><?php echo $this->title() ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <script type="module">
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');

        if ('connection' in navigator && navigator.connection.saveData === true) {
            document.documentElement.classList.add('save-data');
        }
    </script>

</head>

<ktml:content>

</html>