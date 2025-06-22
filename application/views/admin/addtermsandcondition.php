<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    	<h1 class="box-title">Terms and Condition</h1>
    </section>
    	<section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Terms and Condition</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
		    		<?=form_open('admin/KGReportcard/add_termsandcondition/')?>
		    		<div class="box-body">
						<div class="form-group col-md-6">
							<label>Title</label>
							<select name="title" class="form-control input-md">
							  <option value="">..Select..</option>
						      <option value="title1">လူမှုဆက်ဆံရေးနှင့် စိတ်လှုပ်ရှားမှုပိုင်းဆိုင်ရာ ဖွံ့ဖြိုးမှု</option>
						      <option value="title2">​ဉာဏဖွံ့ဖြိုးမှု</option>
						      <option value="title3">ကိုယ်တိုင်လုပ်ဆောင်နိုင်မှုစွမ်းရည် (သို့)အလေ့အထ</option>
						      <option value="title4">(က) ကြွက်သားငယ်များထိန်းသိမ်းနိုင်မှု</option>
						      <option value="title5">(ခ) ကြွက်သားကြီးများထိန်းနိုင်မှု</option>

						    </select>
						</div>
						
						<div class="form-group col-md-6">
							<label>Facts</label>	
							<input type="text" name="fact" class="form-control" required>
						</div>
						
					</div>	<!-- box body -->
					<div class="box-footer">
					<button type="submit" class="btn btn-primary">Add</button>
					</div>
					<?=form_close()?>
				</div>
			</div>
		</div>
	

    </section>
</div>

