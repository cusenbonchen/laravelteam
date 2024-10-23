@include('common/header')
@include('common/nav')
<div class="container">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

 
<form action="{{ route('project.updateProject') }}" method="post">


@csrf
    <div class="mb-3">
      <label class="form-label" data-language="code"> </label>
      <input type="text" name="code" class="form-control" value="{{$project->id}}" autocomplete="off" data-language="codePlaceholder">
    </div>
    <div class="mb-3">
    <label class="form-label" data-language="projectName"></label>
    <input name="project_name" class="form-control" value="{{$project->project_name}}" autocomplete="off" data-language="projectNamePlaceholder">
  </div> 
    <div class="mb-3">
      <label class="form-label" data-language="client"> </label>
      <input name="client" class="form-control" value="{{$project->client}}" autocomplete="off" data-language="clientPlaceholder">
    </div>
    <div class="mb-3">
      <label class="form-label" data-language="level"></label>
      <input name="level" class="form-control" value="{{$project->level}}" type="number" autocomplete="off" data-language="levelPlaceholder">
    </div>
    <div class="mb-3">
      <label class="form-label" data-language="assignName"></label>
      <select id="assignSelect" style="width: 100%;" multiple="multiple">
    </select>
    <input type="hidden" name="assign" id="assignValue">
    </div>
    <div class="mb-3">
      <label class="form-label" data-language="content"></label>
      <textarea class="form-control" id="content" name="content" id="content" placeholder=".......">{{$project->content}}</textarea>
    </div>
    
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-3" data-language="updateProject"> </button>
    </div>  
    @if(isset($message))
      <p>{{ $message }}</p>
  @endif
</form>
</div>
<script src="https://cdn.tiny.cloud/1/ltctom5nyk9giraujagse281vzske1kur1zazc5wdgd6nure/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>  
<script>
    tinymce.init({
      selector: '#content',
      height: 500,
      toolbar: 'undo redo | blocks | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    }); 
</script>
<script>
 $(document).ready(function() { 
    const defaultValues = JSON.parse(@json($project->assign));
    let allUsers = [];  

    const pushUsertoSelect = (data) => {
        const select = document.getElementById('assignSelect');
        select.innerHTML = '';
        data.forEach(e => {
            const fullName = e.first_name + ' ' + e.last_name;  
            const option = document.createElement('option'); 
            option.value = e.id;
            option.innerHTML = fullName;
            select.appendChild(option);
        });
        $('#assignSelect').val(defaultValues).trigger('change');
    };

    fetch('/api/getAllUser', {
          method: 'get',
          headers: {
              'Content-Type': 'application/json', 
          },
      })
      .then(response => response.json())
      .then(data => { 
        allUsers = data.users;
        pushUsertoSelect(allUsers);
      })
      .catch(error => console.error('Lỗi:', error));

    $('#assignSelect').select2({
        tags: true,
    });

    $('#assignSelect').on('change', function() {
        const selectedValues = $(this).val();
        const matchedNames = selectedValues.map(id => {
            const user = allUsers.find(user => user.id == id);
            return user ? user.first_name + ' ' + user.last_name : id;
        });

        const numericValues = selectedValues.map(Number);
        const jsonArray = JSON.stringify(numericValues);

        $('#assignValue').val(jsonArray);
        console.log('Matched Names:', matchedNames);
    });
});

</script>
@include('common/footer')