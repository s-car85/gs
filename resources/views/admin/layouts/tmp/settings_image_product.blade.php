<!-- The Modal -->
<div class="modal" id="SetImgProModal" style="z-index: 999999999999;">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Settings image:</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                {{ Form::open(array('route' => 'setImage', 'method' => 'post')) }}
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="form-group col-md-6 float-lg-left">
                            {{ Form::label('width', 'Width') }}
                            {{ Form::number('width', (isset($imageGetPro->width))? $imageGetPro->width: '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-md-6 float-lg-left">
                            {{ Form::label('height', 'Height') }}
                            {{ Form::number('height', (isset($imageGetPro->height))? $imageGetPro->height: '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-none">
                        <div class="form-group col-md-6 float-lg-left">
                            {{ Form::label('width', 'Width thumbnail') }}
                            {{ Form::number('width_thu',  (isset($imageGetPro->width_thu))? $imageGetPro->width_thu: '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group col-md-6 float-lg-left">
                            {{ Form::label('height', 'Height thumbnail') }}
                            {{ Form::number('height_thu',  (isset($imageGetPro->height_thu))? $imageGetPro->height_thu: '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group col-md-10 float-lg-left"></div>
                    <div class="form-group col-md-2 float-lg-left">
                        {{ Form::hidden('belong', '{"controller":"UploadImagesController","item":"0"}') }}
                        <button type="submit" class="btn btn-success btn-icon-split float-right">
                                <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                                </span>
                            <span class="text">Save</span>
                        </button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>