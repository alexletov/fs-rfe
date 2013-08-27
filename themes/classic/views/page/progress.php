<?php
/**
 * @file progress.php
 * 
 * @autor Alex Letov
 * 
 * Booking progress view.
 */
$theme = Yii::app()->theme->name;
echo CHtml::cssFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/styles/jquery.jqplot.min.css');
echo CHtml::scriptFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/js/jquery.jqplot.min.js');
echo CHtml::scriptFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/js/jqplot/jqplot.donutRenderer.min.js');
echo CHtml::scriptFile(Yii::app()->getBaseUrl(true).'/public/themes/'.$theme.'/js/jqplot/jqplot.pieRenderer.min.js');
?>
<div class="row-fluid">
    <div class="well">
        <table>
            <tr>
                <td width="50%"><h1>Booking progress</h1><div id="flight" style="height:300px; width:500px;"></div></td>
                <td width="50%"><h1>Slot reservation progress</h1><div id="slot" style="height:300px; width:500px;"></div></td>
            </tr>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
  var dataf = [
    ['Free to book', <?php echo floor(100 - $progress * 100); ?>],['Booked flights', <?php echo floor($progress * 100); ?>]
  ];
  var datas = [
    ['Free slots', <?php echo floor(100 - $sprogress * 100); ?>],['Reserved slots', <?php echo floor($sprogress * 100); ?>]
  ];
  var fplot = jQuery.jqplot ('flight', [dataf],
    {
      seriesDefaults: {
        renderer: jQuery.jqplot.PieRenderer,
        rendererOptions: {
          showDataLabels: true,
          dataLabels: 'percent'
        }
      },
      legend: { show:true, location: 's' }
    }
  );
  var splot = jQuery.jqplot ('slot', [datas],
    {
      seriesDefaults: {
        renderer: jQuery.jqplot.PieRenderer,
        rendererOptions: {
          showDataLabels: true,
          dataLabels: 'percent'
        }
      },
      legend: { show:true, location: 's' }
    }
  );
});
</script>