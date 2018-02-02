<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Address;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(["id"=>'users-form']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthdate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'placeholder'=>'+7 (777) 777-7777']) ?>

    <label class="control-label" for="users-gender">Адреса</label>
    <div class="address_fields" style="border:1px solid #ccc;padding: 15px;">
    	<div id="map-canvas"></div>
	    <? foreach($model->addresses as $address){?>
	    	<?=$form->field($address,'name')->textInput(['class'=>'inline_field','name'=>'Address[name][]','required'=>'false'])->label(false);?>
	    	<?=$form->field($address,'address')->textInput(['class'=>'inline_field','name'=>'Address[address][]','required'=>'false'])->label(false);?>
	    	<br>
	    <?}?>
	    <div class="form-group">
	        <button type="button" class="btn btn-primary add_address">Add address</button>    
	    </div>
	</div>
	<br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<style type="text/css">
	.address_fields{
		overflow: hidden;
	}
	.address_fields .form-group{
    	display: inline-block;
	}
	.inline_field{
		margin-right:15px;
	}
	#map-canvas {
	  height: 300px;
	  width: 400px;
	  margin: 0px;
	  padding: 0px;
	  float: right;
	}

</style>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry,places&ext=.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var field_index=null;
		$(".add_address").click(function(e){
			$(this).parent().before('<div class="form-group field-address-name required has-success"><input type="text" id="address-name" class="inline_field" name="Address[name][]" aria-required="true" placeholder="Name" aria-invalid="false"></div>');
			$(this).parent().before('<div class="form-group field-address-name required has-success"><input type="text" id="address-name" class="inline_field" placeholder="Address" name="Address[address][]" aria-required="true" aria-invalid="false"></div></br>');
		});
		$('#users-form').on('beforeSubmit', function (e) {
			var birthdate = $("#users-birthdate").val();
		    if (!birthdate.match(/[0-3][0-9]\.[0-1][0-9]\.19[0-9]{2}/)) {
		    	alert('Wrong date format');
		        return false;
		    }
			var phone = $("#users-phone").val();		    
		    if (!phone.match(/\+7 \([0-9]{3}\) [0-9]{3}\-[0-9]{4}/)) {
		    	alert('Wrong phone format');
		        return false;
		    }
		    return true;
		});
		$("body").on('click','#address-name',function(){
			$("#map-canvas").show();
			field_index = $(this);
		});
		$("body").on('blur','#address-name',function(){
			//$("#map-canvas").hide();
		});
		var myLatlng = new google.maps.LatLng(41.38, 2.18);
		var myOptions = {
		  zoom: 13,
		  center: myLatlng
		}
		var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
		var geocoder = new google.maps.Geocoder();
		google.maps.event.addListener(map, 'click', function(event) {
		  geocoder.geocode({
		    'latLng': event.latLng
		  }, function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
		      if (results[0]) {
		        field_index.val(results[0].formatted_address);
		      }
		    }
		  });
		});
	});
</script>