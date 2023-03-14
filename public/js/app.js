$(document).ready(function(){
    Render()    
})

const Render = ()  => {

    fetch('http://127.0.0.1:8000/api/orcid/list')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        data.data.forEach(elem => {
            $("#id_tbody").append(`
                <tr id='td_id'>
                    <th>${elem.orcid}</th>
                    <th>${elem.name}</th>
                    <th>${elem.lastName}</th>                              
                    <th> 
                        <button type="submit" class="bi bi-card-list"  onclick="HandleDelete('')">
                        </button>
                    </th>                              
                    <th>${elem.email}</th>                                                        
                    <th>
                        <button type="submit" class="btn btn-danger"  onclick="HandleDelete('${elem.orcid}')">
                           Delete
                        </button>
                    </th>                                                        
                </tr>
            `)
        })
    });
}

const HandleDelete = (orcid) => {

    fetch(`http://127.0.0.1:8000/api/orcid/delete/${orcid}`)
        .then(response => response.json())
        .then(data =>{
            console.log('deleteapp',data)
            $("#id_tbody").empty()
            Swal.fire(
                'Successful!',
                'Orcid delete!',
                'success'
            )
           Render()
        }
         
        );     
}

const ListKey = () =>{

    fetch('http://127.0.0.1:8000/api/orcid/list')
    .then(response => response.json())
    .then(data => {
        console.log(data);
    });

}