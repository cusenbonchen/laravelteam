const allowDrop = (event) => {
  event.preventDefault();
}

const drag = (event, sourceColumn, item) => {
  event.dataTransfer.setData("text", JSON.stringify({ sourceColumn, item }));
}

const renderTaskDragAndDrop = (data) => {
  for (let columnId = 1; columnId <= 5; columnId++) {
    const columnElement = document.getElementById(`column${columnId}`);
    columnElement.innerHTML = ""; 
    data[columnId].forEach((item) => { 
      const spanElement = document.createElement('span');
      spanElement.innerHTML = `<a href="/projectdetail?id=${item.id}"><i class="bi bi-eye"></i></a>`
      const draggedElement = document.createElement("div");
      draggedElement.className = "draggable";
      draggedElement.innerText = item.code;
      draggedElement.dataset.level = item.level;
      draggedElement.dataset.type = item.type; 
      draggedElement.dataset.id = item.id;  
      draggedElement.draggable = true;
      draggedElement.appendChild(spanElement);
      draggedElement.ondragstart = (event) => drag(event, columnId, item); 
      columnElement.appendChild(draggedElement);
    });
  }
};


const showToast = (message, duration) => {
  const toastContainer = document.getElementById('toast-container'); 
  const span = document.createElement('span');
  span.textContent = message;
  span.classList.add('isActive');
  toastContainer.appendChild(span)
  setTimeout(() => {
    toastContainer.removeChild(span);
  }, duration);
}
document.addEventListener('DOMContentLoaded', function () {
   
  const searchBtn = document.getElementById('search');
  const searchBox = document.getElementById('searchBox');
  let searchTimeout;
  if(searchBtn){
    searchBtn.addEventListener('input', ()=>{
      clearTimeout(searchTimeout);
      if(searchBtn.value !== ''){
        searchTimeout = setTimeout(() => {
          searchProject(searchBtn.value);
      }, 1500);
      }else{
        if(searchBox){
          if(searchBox.classList.contains('isActive')){
            searchBox.innerHTML = '';
            searchBox.classList.remove('isActive')
          }
        } 
      } 
    })
  } 
  const searchProject = (value) => {
    // Gọi API để cập nhật dữ liệu 
    fetch('/api/findprojectbycode', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', 
        },
        body: JSON.stringify({
            value  
        }),
    })
    .then(response => response.json())
    .then(data => {  drawSearchBox(data.results)  })
    .catch(error => console.error('Lỗi:', error));  
  }
 
  let lang;
  let previousValue = sessionStorage.getItem('language') || 'vn'; 
  lang = translations[previousValue];
  
  document.getElementById("setLang").addEventListener("change", function () { 
      let selectedValue = this.value;
      lang = translations[selectedValue]; 
      sessionStorage.setItem('language', selectedValue);
      setlangtoUI()  
      setlangtoForm()
  });    
  const drawSearchBox = (data) => { 
    searchBox.innerHTML = '';
    searchBox.classList.add('isActive')
    if(data.length > 0){
      data.forEach(e =>{ 
        const li = document.createElement('li');
        li.innerHTML = `<a href="/projectdetail?id=${e.id}">${e.code}</a>`
        li.dataset.id = e.id;
        searchBox.appendChild(li);
      })
    }else{ 
      searchBox.innerHTML = lang.searchNotFound;
    } 
  } 

  const setlangtoUI = () => { 
    const item = document.querySelectorAll('[data-language]');
    item.forEach(e =>{ 
      const tag = e.dataset.language 
      if (e.tagName.toLowerCase() === 'input') {  
        e.placeholder = lang[tag]
      } else {
        e.textContent = lang[tag]
      }
    })
  }

  const setDefaultSelect = () => {   
    if (previousValue && document.getElementById('setLang').querySelector('option[value="' + previousValue + '"]')) { 
        document.getElementById('setLang').value = previousValue;
    }
    sessionStorage.setItem('language', 'vn');
  }
  

  const setlangtoForm = () => {
    const form = document.querySelectorAll('form');
    if(form){
      form.forEach(e =>{ 
        const inputLang = document.getElementById('language');
        if(inputLang){
          inputLang.value = sessionStorage.getItem('language');
        }else{
          const input = document.createElement('input');
          input.type = 'hidden';
          input.id ='language';
          input.name ='language';
          input.value = sessionStorage.getItem('language');
          e.appendChild(input)
        }
        
  
      })
    } 
  }
  setlangtoForm()
  setlangtoUI(previousValue)
  setDefaultSelect()
})




