<?php
/**
 * @file briefing.php
 * 
 * @autor Alex Letov
 * 
 * Piots briefing view.
 */
?><div class="row-fluid">
    <div class="well">
        <h1>Pilot briefing</h1>
        <table width="100%">
            <tr>
                <td width="50%">
                    <h2>English</h2>
                </td>
                <td>
                    <h2>Russian</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <p><a href="<?php echo Yii::app()->createAbsoluteUrl(""); ?>/public/files/briefing_en.pdf" target="_blank" class="btn btn-primary btn-block">Download briefing EN</a></p>
                </td>
                <td>
                    <p><a href="<?php echo Yii::app()->createAbsoluteUrl(""); ?>/public/files/briefing_ru.pdf" target="_blank" class="btn btn-primary btn-block">Download briefing RU</a></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2>Charts</h2>
                    <p><a href="http://ivaoru.org/sites/default/files/charts/uuee.pdf" target="_blank" class="btn btn-success btn-block">UUEE Charts</a></p>
                    <p><a href="http://ivaoru.org/sites/default/files/charts/uuww.pdf" target="_blank" class="btn btn-success btn-block">UUWW Charts</a></p>
                    <p><a href="http://ivaoru.org/sites/default/files/charts/uuuu.pdf" target="_blank" class="btn btn-success btn-block">Moscow TMA Charts</a></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2>Sceneries</h2>
                    <p>Sceneries will be available soon.</p>
                </td>
            </tr>
        </table>
    </div>
</div>