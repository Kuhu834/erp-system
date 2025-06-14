<form class="form-horizontal" id="routinelife" role="form" method="POST" action="{{route('routine_life.store')}}" enctype="multipart/form-data" data-parsley-validate novalidate>                
                <input type="hidden" name="title" class="form-control" placeholder="Enter a Title" value="title">
                <input type="hidden" id="timepicker" name="from_time" class="form-control" value="07:00 AM">
                <input type="hidden" id="timepicker2" name="to_time" class="form-control" value="07:00 AM">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Cover Image <br><span class="label label-primary">205px X 290px</span><br><br><span class="label label-primary">Max size <= 1MB</span></label>
                    <div class="col-sm-8">                     
                      <input type="file" name="cover_image" class="dropify" value="">
                    </div>
                </div>
                <div class="form-group clearfix">
                  <div class="text-left">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                      <button type="submit" class="btn btn-success waves-effect waves-light save" id="save">Save</button>
                      <a href=""><button type="button" class="btn btn-warning">Cancel</button></a>
                    </div>
                  </div>
                </div>
            </div>    
      </div>
    </div>
  </div>
</form>