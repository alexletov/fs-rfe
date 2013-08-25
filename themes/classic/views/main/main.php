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
                    <div style="text-align:center"><?php echo CHtml::image($image_url.'/images/en.jpg', 'Briefing image', array('class' => 'img-rounded')); ?>
                    </div>
                </div>
                <div class="well">
                    <div class="text-center">
                    <p>The Russian division is glad to present you an event that doesn't require many words. That's Moscow Real Flight Event, which will take place on Saturday, September 7 - Birthday of the Russian capital.</p>
                    <p>As you can see, this year Vnukovo airport (UUWW) has come to replace Domodedovo airport (UUDD), which was never used by us during RFE before.<br />
                    2 airport<br />
                    8 hours<br />
                    more than 10 controllers and FM<br />
                    will do everything for your comfortable stay in the Russian skies.</p>
                    <p>If you want to become an airport-partner, please let us know ASAP. This means that you can ensure an ATC in their airports/ACC for departing / arriving or transit flights.</p>
                    <p>See you in the skies! ;)</p>
                    <p>RU Staff Team.</p></div>
                    
                    <h2>Promo video</h2>
                    <div style="text-align:center">
                        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/SPRQMTDu6vw?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>