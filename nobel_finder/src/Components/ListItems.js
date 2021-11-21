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
      to="/DataSummary"
      style={{ textDecoration: "none", color: "#558aac" }}
    >
      <ListItem button>
        <Tooltip title="Data Summary">
        <ListItemIcon>
          <TimelineIcon />
        </ListItemIcon>
        </Tooltip>
        <ListItemText primary="Data Summary" />
      </ListItem>
    </Link>
    {/* This leads the user to a comparison of datasets between 2021 and 2019 as well as a Don't Quit Your Day Job salary Summary */}
    <Link
      to="/DataComparisons"
      style={{ textDecoration: "none", color: "#558aac" }}
    >
      <ListItem button>
        <Tooltip title="Data Comparison">
        <ListItemIcon>
          <CompareArrowsIcon />
        </ListItemIcon>
        </Tooltip>
        <ListItemText primary="Comparing Datasets" />
      </ListItem>
    </Link>
    {/* This leads the user to filter and search salary location based on a number of filters/criteria */}
    <Link
      to="/FilterAndSearch"
      style={{ textDecoration: "none", color: "#558aac" }}
    >
      <ListItem button>
        <Tooltip title="Filter and Search">
        <ListItemIcon>
          <SearchIcon />
        </ListItemIcon>
        </Tooltip>
        <ListItemText primary="Filter and Search" />
      </ListItem>
    </Link>
    {/* This leads the user to a Google Form that they can fill our to add more information to the database */}
    <Link
      to="/AddResponse"
      style={{ textDecoration: "none", color: "#558aac" }}
    >
      <ListItem button>
        <Tooltip title="Add Response">
        <ListItemIcon>
          <AddIcon />
        </ListItemIcon>
        </Tooltip>
        <ListItemText primary="Add a Response" />
      </ListItem>
    </Link>
  </div>
);

export default mainListItems;
