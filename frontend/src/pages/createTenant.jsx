import React from "react";
import { Link } from "react-router-dom";
import ComponentCreateTenantManager from "../component/componentCreateTenant";



export default function CreateTenant() {
    
  return (

            <div className="create-wrapper p-3">
                <h1 className="h4 p-4 text-primary">Créer un compte pour chaque collocataire (étape 2 sur 2) </h1>
                <div className="p-2 bg-primary">
                    <p className="mb-0 text-white">Lister les personnes qui participent aux comptes</p>
                </div>

                <ComponentCreateTenantManager />
                
                <div className="p-2 bg-primary mt-auto">
                    <Link to="/createRental">
                        <button type="submit" className="mb-0 text-white btn"><u>Retour</u></button>
                    </Link>
                    <Link to="/depense">
                        <button type="submit" className="mb-0 text-white btn"><u>Terminer</u></button>
                    </Link>
                </div>
            </div>
    );
    }