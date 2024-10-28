@include('common/header')
@include('common/nav')
<body>  
    <div class="wrapper"> 
        <div id="projectDetails"></div> 
    </div>  
</body>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const loadDataProject = () => {
        const urlParams = new URLSearchParams(window.location.search);
        const projectId = urlParams.get('id');
        fetch('/api/projectdetail', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json', 
            },
            body: JSON.stringify({
                id: projectId 
            }),
        })
        .then(response => response.json())
        .then(data => {  drowData(data)  })
        .catch(error => console.error('Lỗi:', error));  
    
    }
    loadDataProject();

    const getDataUser = async () => {
        try {
            const response = await fetch('/api/getAllUser', {
                method: 'get',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            return data.users;
        } catch (error) {
            console.error('Lỗi:', error);
            return null; 
        }
    };


    const drowData = async (data) =>{

        const users = await getDataUser();
        const assginArr = JSON.parse(data.assign)
        const matchedUsers = users.filter(user => assginArr.includes(user.id));

        const projectDetailsDiv = document.getElementById('projectDetails');
        projectDetailsDiv.innerHTML = '';
        const content = `
            <a href="/editproject?id=${data.id}" id="editProjectBtn" class="btn btn-primary btn-sm">
                Edit
            </a>
            <p><strong>Assign:</strong><div id="assign"></div></p>
            <h3>Project Details</h3>
            <p><strong>Code:</strong> ${data.code}</p>
            <p><strong>Project Name:</strong> ${data.project_name}</p>
            <p><strong>Client:</strong> ${data.client}</p>
            <p><strong>Content:</strong> ${data.content}</p>
            <p><strong>Level:</strong> ${data.level}</p>
            <p><strong>Type:</strong> ${data.type}</p>
            <p><strong>Process:</strong> ${data.process}</p>
        `;

        projectDetailsDiv.innerHTML = content;
        const assignElement = document.getElementById('assign')
        matchedUsers.forEach(e =>{
            const html = `<span> ${e.first_name + e.last_name} </span>`;

            assignElement.insertAdjacentHTML('beforeend', html);
        })
    }
})

</script>
</html>
@include('common/footer')