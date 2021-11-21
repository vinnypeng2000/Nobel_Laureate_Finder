import * as React from "react";
import ListItem from "@material-ui/core/ListItem";
import ListItemIcon from "@material-ui/core/ListItemIcon";
import ListItemText from "@material-ui/core/ListItemText";
import HomeIcon from "@material-ui/icons/Home";
import TimelineIcon from "@material-ui/icons/Timeline";
import SearchIcon from "@material-ui/icons/Search";
import AddIcon from "@material-ui/icons/Add";
import FilterListIcon from "@material-ui/icons/FilterList";
import Typography from "@material-ui/core/Typography";
import CompareArrowsIcon from "@material-ui/icons/CompareArrows";
import { Link } from "react-router-dom";
import Tooltip from '@material-ui/core/Tooltip';
// This file is for the tab on our app that allows for quick navigation to different features of the app
export const mainListItems = (
  <div>
    {/* This is for the home button, where there context about what the app is built to do */}
    <Link to="/" style={{ textDecoration: "none", color: "#558aac" }}>
      <ListItem button>
        <Tooltip title="Home">
        <ListItemIcon>
          <HomeIcon />
        </ListItemIcon>
        </Tooltip>
        <ListItemText primary="Home" />
      </ListItem>
    </Link>
    {/* This leads the user to the summary of the 2021 dataset */}
    <Link
      to="/profile"
      style={{ textDecoration: "none", color: "#558aac" }}
    >
      <ListItem button>
        <Tooltip title="Profile">
        <ListItemIcon>
          <TimelineIcon />
        </ListItemIcon>
        </Tooltip>
        <ListItemText primary="Profile" />
      </ListItem>
    </Link>
    {/* This leads the user to a comparison of datasets between 2021 and 2019 as well as a Don't Quit Your Day Job salary Summary */}
    <Link
      to="/details"
      style={{ textDecoration: "none", color: "#558aac" }}
    >
      <ListItem button>
        <Tooltip title="Details">
        <ListItemIcon>
          <CompareArrowsIcon />
        </ListItemIcon>
        </Tooltip>
        <ListItemText primary="Details" />
      </ListItem>
    </Link>
    {/* This leads the user to filter and search salary location based on a number of filters/criteria */}
    <Link
      to="/search"
      style={{ textDecoration: "none", color: "#558aac" }}
    >
      <ListItem button>
        <Tooltip title="Search">
        <ListItemIcon>
          <SearchIcon />
        </ListItemIcon>
        </Tooltip>
        <ListItemText primary="Search" />
      </ListItem>
    </Link>
  </div>
);

export default mainListItems;
