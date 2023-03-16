const HandleDelete = (orc_id) => {
    fetch(`/api/orcid/delete/${orc_id}`)
        .then(response => response.json())
        .then(data =>{
            Swal.fire({
                title: 'Successful!',
                text: 'Successfully Deleted',
                icon: 'success',
            }).then(() => {
                setTimeout(() => {
                    window.location.href = '/';
                }, 100); s
            });
        });
}
