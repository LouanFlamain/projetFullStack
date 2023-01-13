import React from "react";
import { useContext } from "react";
import ComponentCreateTenantManager from "../component/componentCreateTenant";
import Header from "../component/header";
import { context } from "../context/context";

export default function UpdateRental() {
  const { logged, setLogged } = useContext(context);
  return (
    <>
      <Header />
      <div className="create-wrapper pt-0 p-3">
        <p className="bg-primary p-2 text-white text-end">
          {/* rendre le prénom de l'user.id */}
          Vous êtes identifié comme <em>{logged.user.username}</em>
        </p>
        {/* vérifier si ce n'est pas méthode POST */}
        <form method="GET" action="updateRental">
          <div className="p-4 pt-0">
            <div className="form-group row p-2">
              <label
                for="title"
                className="col-sm-2 col-form-label col-form-label-sm"
              >
                Titre:
              </label>

              <div className="col-sm-10 ">
                <input
                  type="text"
                  className="form-control form-control-sm"
                  id="title"
                />
              </div>
            </div>

            <div className="form-group row p-2">
              <label
                for="description"
                className="col-sm-2 col-form-label col-form-label-sm"
              >
                Description:
              </label>

              <div className="col-sm-10 ">
                <input
                  type="text"
                  className="form-control form-control-sm p-5"
                  id="description"
                />
              </div>
            </div>
          </div>
        </form>

        <h2 className="h4 p-4 mb-0 pb-2">Noms des colocataires :</h2>

        <ComponentCreateTenantManager />

        <div className="p-2 bg-primary mt-auto">
          {/* update Rental de la BDD */}
          <button type="submit" className="btn text-white" href="CreateTenant">
            Sauvegarder
          </button>
        </div>
      </div>
    </>
  );
}
