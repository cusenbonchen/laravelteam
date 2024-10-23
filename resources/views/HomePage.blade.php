@include('common/header')
@include('common/nav')
<div class="container">
  <div class="d-flex justify-content-between mt-5">
    <a href="/createproject" class="btn btn-primary mb-3" data-language="addProject"></a>
    <div class="search-wrap">
      <input id="search" class="form-control me-2" type="search" data-language="searchPlaceholder" placeholder="" aria-label="Search">
      <ul id="searchBox"></ul>
    </div> 
  </div>
  <div class="process">
      <div class="column">
          <h3 data-language="assign"> </h3>
          <div class="table" id="column1" ondrop="drop(event, 1)" ondragover="allowDrop(event)">
          <!-- Mục bảng cột 1 -->
          </div>
      </div>

      <div class="column">
          <h3 data-language="working"> </h3>
          <div class="table" id="column2" ondrop="drop(event, 2)" ondragover="allowDrop(event)">
          <!-- Mục bảng cột 2 -->
          </div>
      </div>

      <div class="column">
          <h3 data-language="feedback"> </h3>
          <div class="table" id="column3" ondrop="drop(event, 3)" ondragover="allowDrop(event)">
          <!-- Mục bảng cột 3 -->
          </div>
      </div>
      <div class="column">
          <h3 data-language="done"> </h3>
          <div class="table" id="column4" ondrop="drop(event, 4)" ondragover="allowDrop(event)">
          <!-- Mục bảng cột 4 -->
          </div>
      </div>
      <div class="column">
          <h3 data-language="publish"> </h3>
          <div class="table" id="column5" ondrop="drop(event, 5)" ondragover="allowDrop(event)">
          <!-- Mục bảng cột 5 -->
          </div>
      </div>
    </div>
</div>
  
  
  <script>
    
    const columnsData = {
        1: [],
        2: [],
        3: [],
        4: [],
        5: [],
      };   
    const idUser = document.getElementById('userName').dataset.id;
    fetch('/api/getProjectByUserId', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', 
        },
        body: JSON.stringify({
            "id" : idUser
        }),
    })
    .then(response => response.json())
    .then(data => {  
      data.forEach((project) => { 
        if (columnsData.hasOwnProperty(project.process)) { 
          columnsData[project.process].push(project);
        }
      }); 
      renderTaskDragAndDrop(columnsData);
    })


    function drop(event, targetColumn) {
      event.preventDefault();
      
      const data = event.dataTransfer.getData("text");
      
      const { sourceColumn, item } = JSON.parse(data); 
      if (sourceColumn !== targetColumn) { 
        columnsData[sourceColumn] = columnsData[sourceColumn].filter((i) => i.id !== item.id);
        columnsData[targetColumn] = columnsData[targetColumn].filter((i) => i.id !== item.id); 
        columnsData[targetColumn].push(item);  
        // Gọi API để cập nhật dữ liệu 
        fetch('/api/updateprocess', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', 
            },
            body: JSON.stringify({
                "id" : item.id,
                "process": targetColumn
                
            }),
        })
        .then(response => response.json())
        .then(data => { 
          showToast(data.message, 3000);
          renderTaskDragAndDrop(columnsData)
          console.log(data)
        })
        .catch(error => console.error('Lỗi:', error)); 
      }
    }

    
  </script>
</div>
@include('common/footer')