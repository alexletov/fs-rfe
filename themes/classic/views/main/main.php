<?php
/**
 * @file main.php
 * 
 * @autor Alex Letov
 * 
 * Main view file. Default RFE Moscow 2013 Theme.
 */
$theme = Yii::app()->theme->name;
$image_url = Yii::app()->getBaseUrl(true).'/public/themes/'.$theme;
?><div class="row-fluid">
                <div class="well">
                    <div style="text-align:center"><?php echo CHtml::image($image_url.'/images/en.png', 'Briefing image', array('class' => 'img-rounded')); ?>
                    </div>
                </div>
                <div class="well">
                    <p>Dear IVAO members, <br />
                    The Russian Division is glad to present you, for the second time, the event that occurs only once per year in Russia, an event that connect our great country from Kaliningrad to Petropavlovsk-Kamchatsky, as well as our friends from other countries, this is the time when both your virtual plane in the real sky soars real aircraft, it's a Moscow Real Flight Event that will be on air on Saturday, November 24, 2012. 2 airports, 8 hours, 10 ATC and 2 FM drivers will do everything to make you feeling comfortable in the Russian skies.</p>
                    <h2>Promo video</h2>
                    <div style="text-align:center">
                        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/50TtrsiFGC4?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>