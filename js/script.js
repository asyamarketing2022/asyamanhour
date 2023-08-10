let users_id = document.querySelectorAll('.user-id');
let users_row = document.querySelectorAll('.table-row_user');
let tab_form = document.querySelector('#edit_employee .tab-content');

Array.from(users_row).forEach((user_row) => {

        user_row.addEventListener('click', (e) => {

            table_data = user_row.children;

            let tr = table_data[1].innerText;

            // document.cookie = "selected_item"+tr;


            // user_row.setAttribute("value", td);
       });
}); 

//Search function

// let searchInput = document.querySelectorAll('.search');

// Array.from(searchInput).forEach((search) => {
//     search.addEventListener('keyup', () => {
//         let input, filter, tr, table_data, txtValue
    
//         // input = document.querySelector(".search");
//         filter = search.value.toUpperCase();
//         tr = document.querySelector('.table-form');
//         table_data = document.querySelectorAll(".table-form td:nth-child(3)");
    
//         console.log('keyup')
    
//         Array.from(table_data).forEach((td) => {
    
//             txtValue = td.textContent || td.innerText;
//             if (txtValue.toUpperCase().indexOf(filter) > -1) {
    
//                 td.parentNode.style.display = "";
    
//             } else {
    
//                 td.parentNode.style.display = "none";
    
//             }
    
//         });
//     });
// });

//Search User Filter

let searchUser_input = document.querySelectorAll('.searchUser-input');

Array.from(searchUser_input).forEach((search) => {
    search.addEventListener('keyup', () => {
        let input, filter, tr, table_data, txtValue
   

        // input = document.querySelector(".search");
        filter = search.value.toUpperCase();
        tr = document.querySelector('.search-user');
        // table_data = document.querySelectorAll(".search-user td:nth-child(1)");
        table_data = document.querySelectorAll(".search-user li:nth-child(2)");

        let searchValue = search.value;
    
        Array.from(table_data).forEach((li) => {

            txtValue = li.textContent || li.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
    
                li.parentNode.style.display = "grid";
    
            } else  {

                li.parentNode.style.display = "";
            }
        });

        Array.from(table_data).forEach((li) => {

            if ( searchValue == "" || searchValue == null ) {
    
               li.parentNode.style.display = "";
    
            }
        });
    });
});

// Disable Input
function disableInput() {
    let viewButton = document.querySelectorAll('.view-project');
    let inputbox = document.querySelectorAll(".input");

    Array.from(viewButton).forEach((view) => {

        view.addEventListener('click', () => {

            Array.from(inputbox).forEach((input) => {

                // input.setAttribute('readonly', true);
                // console.log(input)

            });
    
        });

    });

}

disableInput();

//Create dynamic Input
function dynamicInput() {
    let searchUser = document.querySelectorAll('.search-user');

    Array.from(searchUser).forEach((rowUser) => {

        rowUser.addEventListener('click', () => {

            let nameofuser = rowUser.querySelector('.nameofuser').innerText;
            // let pickBtn = rowUser.querySelector('.pickBtn')
            let btnValue = rowUser.getAttribute('value');
            const input = document.createElement(`input`);
            const inputID = document.createElement(`input`);
            const div = document.createElement(`div`);
            const p = document.createElement(`p`);
            
            p.innerHTML = " x ";
            // p.setAttribute('class', 'removeInput');
            // p.classList.add(btnValue)
            inputID.setAttribute('value', btnValue);
            inputID.setAttribute('name', 'userID[]');
            div.classList.add('content__info');
            div.classList.add('text-center');
            input.setAttribute('name', 'user[]');
            input.setAttribute('class', 'user');
            // input.setAttribute('id', btnValue);
            input.setAttribute('value', nameofuser);

            div.appendChild(p);
            div.appendChild(input);
            div.appendChild(inputID);

            document.querySelector('.assign').appendChild(div);

            rowUser.classList.add('d-none');
          
            // document.querySelector('.dateToday').valueAsDate = new Date();

            //Remove Dynamic Input
            
          

            function removeInput() {

                let removeIcon = document.querySelectorAll('.content__info p');
            
                Array.from(removeIcon).forEach((removeInput) => {
            
                    removeInput.addEventListener('click', () => {
            
                        removeInput.parentElement.remove();
                        rowUser.classList.remove('d-none');

                    });
                    
                });
            
            }

            removeInput();
        });
        
    });
    
}

// let searchUser = document.querySelector('.searchUser-input');

// searchUser.addEventListener('keyup', () => {
//     dynamicInput();
  
// });

function refreshPage() {

    let closeBtn = document.querySelectorAll('.close');

    Array.from(closeBtn).forEach((close) => {

        close.addEventListener('click', () => {

            location.reload();
            // console.log(close);

        });

    });

}

refreshPage();

function download_csv() {
    
    let dl_csv = document.querySelector('.dl_csv');

    dl_csv.addEventListener('click', (e) => {

        let tableRow = document.querySelectorAll('tr.table-row_user');

        //define the heading for each row of the data
        let csv = 'ID,Name,User ID,Position,Department,Action,Action Status,Source,Added At\n';

        //merge the data with CSV
        Array.from(tableRow).forEach((row) => {

        let td_array = row.children;
        let td_text = [];
        let td_container = [];
 
            for (let i = 0; i < td_array.length; i++) {

                td_text.push(td_array[i].innerText);
            }
       
            td_container.push(td_text);

            csv += td_container.join(',');
            csv += "\n";

       });
        
        //display the created CSV data on the web browser 
        // document.write(csv);

        var hiddenElement = document.createElement('a');
        hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
        hiddenElement.target = '_blank';
        
        //provide the name for the CSV file to be downloaded
        hiddenElement.download = 'Users History.csv';
        hiddenElement.click();

  
    }); 
}
download_csv();


// let prevent = document.querySelector('.prevent');

// prevent.addEventListener('click', (e) => {

//     e.preventDefault();
//     console.log(prevent);

// });



