import React from "react";
import { Link } from "react-router-dom";

export default function CreateTenant() {
    const submit = (event) => {
      event.preventDefault();
    };
    return (

            <div className="create-tenant p-3">
                <h1 className="h4 p-4 text-primary">Créer des comptes (étape 2 sur 2) </h1>
                <div className="p-2 bg-primary">
                    <p className="mb-0 text-white">Lister les personnes qui participent aux comptes</p>
                </div>

                <div className="create-tenant__content pt-4 pb-2 mx-auto ">
                    <div className="d-flex flex-row align-items-center create-tenant__info">
                        <p className="p-2 border border-secondary rounded mb-0 w-25">"le nom du manager"</p>
                        <p className="mb-0 pl-2 text-primary">(ceci est votre identifiant)</p>
                    </div>

                    {/* Ligne créée en JS */}
                    <div className="d-flex flex-row align-items-center create-tenant__info | js-infos_new-tenant-create">
                        <p className="p-2 border border-secondary rounded mb-0 w-25">"le nom du nouveau tenant"</p>
                        <p className="mb-0 pl-2 text-primary">(ceci est votre identifiant)</p>
                    </div>
                
               
                    <button type="button" class="btn mt-3" data-toggle="modal" data-target="#exampleModalCenter">
                        <u>Ajouter un participant</u>
                    </button>

                
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form className="card-body p-5" onSubmit={submit} method="POST">
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="p-2 bg-primary mt-auto">
                    <Link to="/depense">
                        <button type="submit" className="mb-0 text-white btn"><u>Terminer</u></button>
                    </Link>
                </div>
            </div>
    );
    }