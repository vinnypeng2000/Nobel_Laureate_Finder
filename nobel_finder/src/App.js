import React from "react";
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
import Container from "@material-ui/core/Container";
import Grid from "@material-ui/core/Grid";
import Paper from "@material-ui/core/Paper";

const express = require('express');
const app = express();

app.get('/', (req, res) => res.send('Hello World!'));

app.listen(3000, () => console.log('Example app listening on port 3000!'));

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

    <main className={classes.content}>
      <div className={classes.appBarSpacer} />
      <Container maxWidth="lg" className={classes.container}>
        <Grid container spacing={3}>

          <Grid item xs={12} md={8} lg={8}>
            <Paper className={classes.paper}>
              <center>
                <h2>About This Tool</h2>
              </center>
            </Paper>
          </Grid>

          <Grid item xs={12} md={4} lg={4}>
            <Paper className={classes.paper}>
              <center>
                <h2>Feature</h2>
              </center>
            </Paper>
          </Grid>

          <Grid item xs={12} md={4} lg={4}>
            <Paper className={classes.paper}>
              <center>
                <h2>ADs</h2>
              </center>
            </Paper>
          </Grid>

          <Grid item xs={12} md={8} lg={8}>
            <Paper className={classes.paper}>
              <center>
                <h2>About Us</h2>
              </center>
            </Paper>
          </Grid>

        </Grid>
      </Container>
    </main>

  </div>
  );
}

