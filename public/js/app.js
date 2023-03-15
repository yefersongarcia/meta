$(document).ready(function(){
    Render()    
})

const Render = ()  => {
    fetch('http://127.0.0.1:8000/api/orcid/list')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        $("#id_tbody").empty();
        data.data.forEach(elem => {
            $("#id_tbody").append(`
                <tr id='td_id'>
                    <th>${elem.orcid}</th>
                    <th>${elem.name}</th>
                    <th>${elem.lastName}</th>                              
                    <th>${elem.keywords.map(keyword => `<li>${keyword.cont}</li>`).join(' ')}</th>       
                    <th>${elem.email}</th>                                                        
                    <th>
                        <button type="submit" class="btn btn-danger"  onclick="HandleDelete('${elem.orcid}')">
                           Delete
                        </button>
                    </th>                                                        
                </tr>
            `)
        });

        $("#pagination-links").html(data.pagination); // Actualizar el contenido del elemento con el HTML de paginación

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

const RenderPagination = (links) => {
    $("#pagination-links").html(links);
}
