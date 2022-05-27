<?php /**
 * Joomlatools Framework - https://www.joomlatools.com/developer/framework/
 *
 * @copyright   Copyright (C) 2007 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/joomlatools/joomlatools-framework for the canonical source repository
 */

defined('KOOWA') or die; ?>

<?php echo $this->helper('behavior.debugger') ?>

<title content="replace"><?php echo $this->translate('Error').' '.$code.' - '. KHttpResponse::$status_messages[$code]; ?></title>

<script data-inline type="text/javascript">
// Remove all classes from html and body
document.body.className = ''; document.documentElement.className = '';
</script>

<!--[if IE 8]>
<div class="old-ie">
<![endif]-->

<div id="error_page">
    <div class="error_page__head">
        <h1 class="page_header">
            <a href="#error_page" class="page_header__exception"><?php echo $exception ?><?php if($level !== false) : ?> | <?php echo $level ?><?php endif ?></a>
            <span class="page_header__code">[<?php echo $code ?>]</span>
        </h1>
        <div class="page_message">
            <div class="page_message__text"><?php echo $message ?></div>
        </div>
        <div id="the_error">
            <div class="error_container">
                <div class="error_container__header">
                    <?php echo $this->helper('debug.path', array('file' => $file)) ?>:<span class="linenumber"><?php echo $line ?></span>
                </div>
                <div class="error_container_code">
                    <?php echo $this->helper('debug.source', array('file' => $file, 'line' => $line)) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="page_content">
        <?php $trace_steps = $this->helper('debug.trace', array('trace' => $trace)); ?>
        <div id="trace_container" class="trace_container" style="counter-reset: trace-counter <?php echo count($trace_steps)+1; ?>">
            <div id="trace_wrapper">
                <?php foreach ($trace_steps as $i => $step): ?>
                <a id="trace__item--<?php echo $i; ?>" class="trace__item" href="#source<?php echo $i ?>">
                    <span class="trace__item__header">
                        <?php echo $step['function'] ?>(<?php if ($step['args']): $args_id = 'args'.$i; ?><?php endif ?>)
                    </span>
                </a>
                <?php unset($args_id, $source_id); ?>
                <?php endforeach ?>
            </div>
        </div>
        <div id="codes_container" class="codes_container" style="counter-reset: source-counter <?php echo count($trace_steps)+1; ?>">
            <?php foreach ($this->helper('debug.trace', array('trace' => $trace)) as $i => $step): ?>
            <?php if ($step['file']): $source_id = 'source'.$i; ?>
            <div id="<?php echo $source_id ?>" class="codes_container__item">
                <div class="codes_container__content">
                    <h3>
                        <?php echo $step['function'] ?>(<?php if ($step['args']): $args_id = 'args'.$i; ?><?php endif ?>)
                    </h3>
                    <div class="error_container">
                        <div class="error_container__header">
                            <span class="file"><?php echo $this->helper('debug.path', array('file' => $step['file'])) ?></span>:<span class="linenumber"><?php echo $step['line'] ?></span>
                        </div>
                        <?php if (isset($source_id)): ?>
                        <div class="error_container__code">
                            <pre class="source_wrap"><code class="hljs php"><?php echo $step['source'] ?></code></pre>
                        </div>
                        <?php endif ?>
                    </div>
                    <?php if ($step['args']): $args_id = 'args'.$i; ?><?php endif ?>
                    <?php if (isset($args_id)): ?>
                    <div id="<?php echo $args_id ?>" class="args">
                        <h4>Arguments</h4>
                        <div class="arguments_wrapper">
                            <table cellspacing="0">
                                <?php foreach ($step['args'] as $name => $arg): ?>
                                    <tr>
                                        <td width="1"><code><?php echo $name ?></code></td>
                                        <td><pre class="arguments"><?php echo $this->helper('debug.dump', array('value' => $arg, 'object_depth' => $i ? 1 : 4)) ?></pre></td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
            </div>
            <?php else: ?>
            {<?php echo 'PHP internal call' ?>}
            <?php endif ?>
            <?php unset($args_id, $source_id); ?>
            <?php endforeach ?>
        </div>
    </div>
</div>

<!--[if IE 8]>
</div>
<![endif]-->