import React from 'react';
import { GoogleLogout } from 'react-google-login';

const clientId =
  '480656201667-71rt9gpkl1qm8m7eni4o4fg3udvkdu4d.apps.googleusercontent.com';

function Logout() {
  const onSuccess = () => {
    console.log('Logout made successfully');
    alert('Logout made successfully');
  };

  return (
    <div>
      <GoogleLogout
        clientId={clientId}
        buttonText="Logout"
        onLogoutSuccess={onSuccess}
      ></GoogleLogout>
    </div>
  );
}

export default Logout;
