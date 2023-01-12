import React, { useState } from "react";
import { Link } from "react-router-dom";
import { Modal, Button, Form } from "react-bootstrap";

function MyVerticallyCenteredModal(props) {
    const [show, setShow] = useState(false);
    const submit = (event) => {
        event.preventDefault();
      };

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);
  
    return (
      <>
        <Button variant="mt-4 pt-4 text-primary" onClick={handleShow}>
          <u>Ajouter un colocataire</u>
        </Button>
  
        <Modal show={show} onHide={handleClose} centered>
          <Modal.Header closeButton>
            <Modal.Title>Créer un nouveau colocataire</Modal.Title>
          </Modal.Header>
          <Modal.Body>
            <Form onSubmit={submit} method="POST" action="createTenant">
              <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
                <Form.Label>Tapez son Email</Form.Label>
                <Form.Control
                  type="email"
                  placeholder="name@example.com"
                  autoFocus
                />
              </Form.Group>
            </Form>
          </Modal.Body>
          <Modal.Footer>
            <Button variant="secondary" onClick={handleClose}>
              Annuler
            </Button>
            <Button type="submit" variant="primary" onClick={handleClose}>
              Sauvegader
            </Button>
          </Modal.Footer>
        </Modal>
      </>
    );
  }


export default function CreateTenant() {
    const [show, setShow] = useState(false);
    
    return (

            <div className="create-wrapper p-3">
                <h1 className="h4 p-4 text-primary">Créer un compte pour chaque collocataire (étape 2 sur 2) </h1>
                <div className="p-2 bg-primary">
                    <p className="mb-0 text-white">Lister les personnes qui participent aux comptes</p>
                </div>

                <div className="create-tenant__content p-4 mx-auto ">

                    <div className="d-flex flex-row align-items-center create-tenant__info">
                        <p className="p-2 border border-secondary rounded mb-0 w-25">"le nom du manager"</p>
                        <p className="mb-0 pl-2 text-primary">(ceci est votre identifiant)</p>
                    </div>

                {/* A générer au moment après la validation de la modal */}
                <div className="d-flex flex-row align-items-center create-tenant__info | js-infos_new-tenant-create">
                    <p className="p-2 border border-secondary rounded mb-0 w-25">"le nouveau "tenant"</p>
                    <button className="btn mb-0 pl-2 text-primary">supprimer</button>
                </div>

                    <MyVerticallyCenteredModal
                        show={show}
                        onHide={() => setShow(false)}
                    />

                </div>
                
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