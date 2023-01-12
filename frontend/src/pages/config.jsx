import React from "react";

export default function Config() {
  return (
    <>
    <div className="p-3">

      <p className="h2 text-primary">Creer des comptes (Etape 1 sur 2)</p>
      <div>

        <span>

          <p className="bg-primary text-white p-3 pb-5">
            Choisissez un titre explicite et donnez plus d'informations dans la description
          </p>
          
        </span>

      </div>
      <form>

        <div className="p-5">
          <div className="form-group row p-2">

            <label for="title" className="col-sm-2 col-form-label col-form-label-sm">Titre:</label>
            

            <div className="col-sm-10 ">

              <input type="text" className="form-control form-control-sm" id="title"/>

            </div>

          </div>
        

          <div className="form-group row p-2">

            <label for="description" className="col-sm-2 col-form-label col-form-label-sm">Description:</label>
            

            <div className="col-sm-10 ">

            <input type="text" className="form-control form-control-sm p-5" id="description"/>

            </div>

          </div>





         
        </div>
      
      <ul className="list-group pb-4 d-inline">
        
        <span className="d-flex p-1"><li className="list-group-item d-inline">Hassan</li>  
        <button> Supprimer </button></span>
        <span className="d-flex p-1"><li className="list-group-item d-inline">Hassan</li>  
        <button> Supprimer </button></span>
        <span className="d-flex p-1"><li className="list-group-item d-inline">Hassan</li>  
        <button> Supprimer </button></span>
        
        

        
      </ul>

      <div>

      <span>

        <p className="bg-primary  p-3 pb-5">
          <a className="text-white" href="CreateTenant">Continuer</a>
        </p>
        
      </span>

      </div>

      </form>


 




      

      




      

    
    </div>
    
    </>
    );
  }
