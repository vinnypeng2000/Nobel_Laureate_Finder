import React from "react";
import { Link } from "react-router-dom";
import clsx from "clsx";
import useStyles from "./Components/UseStyles.js";
import AppBar from "@material-ui/core/AppBar";
import Toolbar from "@material-ui/core/Toolbar";
import IconButton from "@material-ui/core/IconButton";
import MenuIcon from "@material-ui/icons/Menu";
import Drawer from "@material-ui/core/Drawer";
import ChevronLeftIcon from "@material-ui/icons/ChevronLeft";
import Divider from "@material-ui/core/Divider";
import List from "@material-ui/core/List";
import mainListItems from "./Components/ListItems";
// import Title from "./Title";
import PageTitle from "./Components/PageTitle";
import CssBaseline from "@material-ui/core/CssBaseline";
import Login from './Components/Login';
import Logout from './Components/Logout';


export default function App() {

  const classes = useStyles();
    const [open, setOpen] = React.useState(true);
    const handleDrawerOpen = () => {
        setOpen(true);
    };
    const handleDrawerClose = () => {
        setOpen(false);
    };

  return (
      <div className={classes.root}>
        <CssBaseline />

        <AppBar
            position="absolute"
            className={clsx(classes.appBar, open && classes.appBarShift)}
        >
        <Toolbar className={classes.toolbar}>
            <IconButton
                edge="start"
                color="inherit"
                aria-label="open drawer"
                onClick={handleDrawerOpen}
                className={clsx(
                classes.menuButton,
                open && classes.menuButtonHidden
                )}
            >
                <MenuIcon />
            </IconButton>
            <PageTitle text="Home" />
        </Toolbar>
        <div style={{display: 'flex', justifyContent: 'flex-end'}}>
          <Login />
        </div>
        </AppBar>

        <Drawer
            variant="permanent"
            classes={{
            paper: clsx(classes.drawerPaper, !open && classes.drawerPaperClose),
            }}
            open={open}
        >
            <div className={classes.toolbarIcon}>
                <IconButton onClick={handleDrawerClose}>
                <ChevronLeftIcon />
                </IconButton>
            </div>
            <Divider />
            <List>{mainListItems}</List>
        </Drawer>
  </div>
  );
}
