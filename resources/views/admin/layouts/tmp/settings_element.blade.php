<div class="modal" id="addElemModal" style="z-index: 999999999999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">add element:</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <form role="form" id="addS">
                            <div class="col-md-12" style="height: 169px;">
                                <div class="form-group">
                                    <label class="col-md-12 control-label"> Label Text </label>
                                    <div class="col-md-10">
                                        <input class="form-control field" data-type="input" type="text" name="setLabel" onkeydown="keyDownTextField(this.value)" id="setLabel" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 float-lg-left">
                                    <label class="control-label"> Options </label>
                                    <div class="">
                                        <input type="text" class="form-control field col-md-11" id="selOpt" onkeydown="keyDownTextFieldValue(this.value)" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 float-lg-left">
                                    <label class="control-label"> Values </label>
                                    <div class="">
                                        <input type="text" class="form-control field col-md-11" id="selVal" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 float-lg-left">
                                    <label class="control-label"> Quantity </label>
                                    <div class="">
                                        <input type="number" class="form-control field col-md-12" value="1" id="selQua" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 float-lg-left">
                                    <label class="control-label">---</label>
                                    <div class="">
                                        <button type="button" class="btn btn-primary" id="addSel">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="ovq">
                                {{--@if(isset($product->id) && isset($product->productImages))
                                    <div class="form-group" id="sel-1">
                                        <div class="form-group col-md-4 float-lg-left">
                                            <input type="text" class="form-control field col-md-11" id="selOpt" value="tttttttt" disabled="">
                                        </div>
                                        <div class="form-group col-md-4 float-lg-left">
                                            <div class="">
                                                <input type="text" class="form-control field col-md-11" id="selVal" value="tttttttt" disabled="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2 float-lg-left">
                                            <div class="">
                                                <input type="number" class="form-control field col-md-12" id="selQua" value="1" disabled="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2 float-lg-left">
                                            <div class="">
                                                <button type="button" class="btn btn-danger delSel" id="1">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($product->productAddition as $elements)
                                        <div class="form-group col-md-6 float-lg-left" id="element-{{ $elements->id }}">
                                            <div class="col-md-6 float-lg-right">
                                                <button type="submit" class="editElement btn btn-primary btn-sm" id="{{ $elements->id }}" title="Edit" data-toggle="tooltip"><i class="fas fa-edit"></i></button>
                                                <button type="submit" class="deleteElement btn btn-danger btn-sm" id="{{ $elements->id }}" title="Delete" data-toggle="tooltip"><i class="fas fa-trash"></i></button>

                                            </div>
                                            <label for="color" class="control-label">{{ $elements->name }}</label>
                                            <select class="form-control w-75" name="{{ $elements->name }}" style="min-width: 40px; height: auto">
                                                <option>Selektuj:</option>
                                                @foreach($elements->children as $el)
                                                    <option id="{{ $el->id }}" value="{{ $el->value }}">{{ $el->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach
                                @endif--}}
                            </div>

                            <div id="view" class="col-md-12">
                                <div class="col-md-6">
                                    <div id="elClone">
                                        <label for="" class="control-label "><span class="createLab"></span>:</label>
                                        <select class="form-control" name="createSel" id="createSel">
                                            <option>Selektuj:</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                    <div class="modal-footer">
                        <div class="form-group col-md-12 float-lg-right">
                            <div class="form-group col-md-5 float-lg-right">
                                <button data-dismiss="modal" class="btn btn-danger float-lg-right">Cancel</button>
                                <button id="addElement" class="btn btn-info float-lg-left">Save</button>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>
