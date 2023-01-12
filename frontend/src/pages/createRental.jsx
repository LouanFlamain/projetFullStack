import React from "react";
import { Link } from "react-router-dom";

export default function CreateRental() {
  return (
    <>
    <div className="create-wrapper p-3">

      <p className="h4 p-4 text-primary">Creer la location (Etape 1 sur 2)</p>
      <div>
          <p className="p-2 bg-primary text-white">
            Choisissez un titre explicite et donnez plus d'informations dans la description
          </p>
      </div>
      {/* vérifier si ce n'est pas méthode POST */}
      <form method="GET" action="createRental">

        <div className="p-4">
          <div className="form-group row p-2">

            <label for="title" className="col-sm-2 col-form-label col-form-label-sm">Nom de la location:</label>
            

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





          <div className="form-group row p-2">

            <label for="rent" className="col-sm-2 col-form-label col-form-label-sm">Montant du loyer:</label>
            

            <div className="col-sm-10">

              <input type="text" className="form-control form-control-sm " id="rent"/>

            </div>

          </div>
        </div>

      </form>
      
      <div className="p-2 bg-primary mt-auto">
        <Link to="/createTenant">
          <button type="submit" className="btn text-white" href="CreateTenant">Continuer</button>
        </Link>
      </div>

   


 




      






      

    
    </div>
    
    </>
    );
  }
