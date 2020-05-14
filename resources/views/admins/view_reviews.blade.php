@extends('layouts.app')

@section('content')

    <!-- Page Content -->

    <div id="page-content-wrapper">

        <div class="container-fluid py-3" id="reviews">
          <!-- table-->
          <div class="card">
              <div class="card-header bg-blue text-light">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb-0">Reviews</h4>
                  </div>
                  <!-- <div class="col-sm-6" style="text-align: right;">
                    <a class="btn btn-default btn-yellow" href="#" data-toggle="modal" data-target="#ShopModal" data-whatever="@mdo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Shop</a>
                  </div> -->
                </div>
              </div>
              <div class="table-responsive small">
                  <table class="table table-condensed" id="reviewTable">
                      <thead>
                          <tr>
                              <th><span>Shop Name</span></th>
                              <th><span>Review By</span></th>
                              <th><span>Star Rating</span></th>
                              <th><span>Review</span></th>
                              <th><span>Memeber Type</span></th>
                              <th><span>Review Date</span></th>
                              <th><span>Action</span></th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          {{ csrf_field() }}
                         <?php if(isset($reviews) && count($reviews) > 0){ ?>
                           @foreach($reviews as $review)
                             <tr class="ReviewInfo{{$review->id}}">
                               <td>{{ $review->shop_name }}</td>
                               <td>{{ $review->name }} {{ $review->lname }}</td>
                               <td>{{ $review->star_rating }}</td>
                               <td>{{ $review->review_details }}</td>
                               <td>{{ ucfirst($review->review_member_type) }}</td>
                               <td><?php echo date('d M Y',strtotime($review->review_date)); ?></td>
                               <td class="px-2 text-nowrap">
                                 <?php if($review->review_status == 'pending'){ ?>
                                 <a href="#" class="approve_link btn btn-sm btn-danger" data-id="{{ $review->id }}">Approve</a>
                               <?php }else { ?>
                                 <a href="#" class="btn btn-sm btn-success">Approved</a>
                               <?php } ?>
                               </td>
                             </tr>
                           @endforeach
                        <?php }else { ?>
                          <tr>
                            <th id="yet">
                              <h2>Reviews are not added yet</h2>
                            </th>
                          </tr>
                        <?php } ?>
                        </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-shops justify-content-center">
             </ul>
		      </div>
        </div>
    </div>

<script type="text/javascript">
  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.approve_link').on('click',function(event){
  		event.preventDefault();

  		var data = {
  			'id' : $(this).data('id')
  		};

      $.ajax({
          type:'POST',
          url:"{{ url('member/approve_link') }}",
  				data:data,
  				dataType:"json",
          success:function(data){
            alert(data);
            location.reload();
          }
      });
    });
});
</script>
<style media="screen">
.close{
  font-size: 1.4rem;
}
</style>
@endsection
