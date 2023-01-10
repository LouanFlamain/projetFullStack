import React from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import { ContextProvider } from "./context/context";
import Login from "./pages/login";
import Register from "./pages/register";

function App() {
  return (
    <ContextProvider>
      <BrowserRouter>
        <div className="App">
          <Routes>
            <Route path="/login" element={<Login />} />
            <Route path="/register" element={<Register />} />
          </Routes>
        </div>
      </BrowserRouter>
    </ContextProvider>
  );
}

export default App;
