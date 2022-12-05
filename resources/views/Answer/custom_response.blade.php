<div class="block_error_ajax"></div>
@if(session("success"))
    <div class="alert alert-success alert-dismissible fade show p-2 text-14">{{ session("success") }}
    </div>
@elseif(session("error"))
    <div class="alert alert-danger alert-dismissible fade show p-2 text-14">{{ session("error") }}
    </div>
@endif

