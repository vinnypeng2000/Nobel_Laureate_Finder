import React from "react";
import clsx from "clsx";
import CssBaseline from "@material-ui/core/CssBaseline";
import useStyles from "./UseStyles.js";

export default function Profile() {

    const classes = useStyles();

    return (
        <div className={classes.root}>
            <CssBaseline />
            <p>Hello World!</p>
        </div>
    )
}