import * as React from "react";
import PropTypes from "prop-types";
import Typography from "@material-ui/core/Typography";
// This component allows for a specific title to bet set for a certain page
export default function WebsiteTitle({ text }) {
  return (
    <Typography component="h1" variant="h6" color="inherit" noWrap>
      {text}
    </Typography>
  );
}