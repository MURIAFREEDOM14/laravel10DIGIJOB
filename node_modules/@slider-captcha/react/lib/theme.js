"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _react = _interopRequireDefault(require("react"));

var _propTypes = _interopRequireDefault(require("prop-types"));

var _light = _interopRequireDefault(require("./style/light"));

var _dark = _interopRequireDefault(require("./style/dark"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

var Theme = function Theme(_ref) {
  var variant = _ref.variant;
  return /*#__PURE__*/_react["default"].createElement("style", {
    suppressHydrationWarning: true
  }, variant === 'dark' ? _dark["default"] : _light["default"]);
};

Theme.propTypes = {
  variant: _propTypes["default"].string.isRequired
};
var _default = Theme;
exports["default"] = _default;