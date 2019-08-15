<div class="col-xl-6 float-lg-left">
    <div class="card border-left-primary ">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary  mb-1">Total Category</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($categories->count())? $categories->count(): '0' }}</div>
                    <div class="text-xs font-weight-bold text-primary  mb-1">Total Sub Category</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-arrow-right fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>