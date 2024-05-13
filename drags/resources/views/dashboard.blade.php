

<div class="container">
    <div class="row">
        <div class="col-md-4" style=" display: flex;  gap: 10px; ">
            
             <ul >
                @foreach ($name as $rows)
                  <li>
                    <span>{{$rows->name}}</span>
                </li>
                @endforeach
                </ul>
            <ul class="sort_menu list-group">
                @foreach ($record as $row)
                <li class="list-group-item" data-id="{{$row->id}}">
                    <span class="handle"></span> {{$row->mark}}</li>
                @endforeach
            </ul>

        </div>
    </div>
</div>
<style>
    .list-group-item {
        display: flex;
        align-items: center;
    }

    .highlight {
        background: #f7e7d3;
        min-height: 30px;
        list-style-type: none;
    }

    .handle {
        min-width: 18px;
        background: #607D8B;
        height: 15px;
        display: inline-block;
        cursor: move;
        margin-right: 10px;
    }
</style>
<script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
<script>
    $(document).ready(function(){

        function updateToDatabase(idString){
           $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
            
           $.ajax({
              url:'{{url('/menu/update-order')}}',
              method:'POST',
              data:{ids:idString},
              success:function(){
                 alert('Successfully updated')
                 //do whatever after success
              }
           })
        }

        var target = $('.sort_menu');
        target.sortable({
            handle: '.handle',
            placeholder: 'highlight',
            axis: "y",
            update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData.join(','))
            }
        })
        
    })
</script>
