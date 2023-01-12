import React, { useState } from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import Header from "./component/header";
import { ContextProvider } from "./context/context";
import Config from "./pages/config";
import Equilibre from "./pages/equilibre";
import Depense from "./pages/depense";
import Login from "./pages/login";
import Register from "./pages/register";
import NeedAuth from "./component/needAuth";

const initialState = {
  isVerify: false,
};

function App() {
  const [logged, setLogged] = useState(false);
  let test = true;
  return (
    <ContextProvider>
      <BrowserRouter>
        <div className="App">
          <Routes>
            <Route path="/login" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route
              path="/config"
              element={
                <NeedAuth logged={logged}>
                  <Config />
                </NeedAuth>
              }
            />
            <Route
              path="/depense"
              element={
                <NeedAuth logged={logged}>
                  <Depense />
                </NeedAuth>
              }
            />
            <Route
              path="/equilibre"
              element={
                <NeedAuth logged={logged}>
                  <Equilibre />
                </NeedAuth>
              }
            />
          </Routes>
        </div>
      </BrowserRouter>
    </ContextProvider>
  );
}

export default App;
