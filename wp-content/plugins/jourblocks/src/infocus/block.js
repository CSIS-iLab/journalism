const { RichText, MediaUpload, PlainText, InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Button } = wp.components;
const { __ } = wp.i18n;
// Import our CSS files
import "./style.scss";
import "./editor.scss";

registerBlockType("jourblocks/focus", {
  title: "In Focus",
  icon: "flag",
  category: "layout",
  keywords: [
    __("Focus", "jourblocks"),
    __("Aside", "jourblocks"),
    __("Case", "jourblocks"),
    __("Box", "jourblocks"),
    __("Sidebar", "jourblocks")
  ],
  description: __(
    "Add a box that blocks off content in a case study or sidebar",
    "jourblocks"
  ),
  attributes: {
    caption: {
      type: "string"
    },
    align: {
      type: "string",
      default: "center"
    }
  },
  supports: {
    align: ["right", "center", "wide"]
  },
  edit({ attributes, className, setAttributes }) {
    return (
      <div className="focus__container">
        <div class="focus__content">
          <InnerBlocks
            allowedBlocks={[
              "core/paragraph",
              "core/image",
              "core/heading",
              "jourblocks/dataviz",
              "jourblocks/audio"
            ]}
          />
        </div>
      </div>
    );
  },

  save({ attributes }) {
    return (
      <div className="focus__container">
        <div class="focus__content">
          <InnerBlocks.Content />
        </div>
      </div>
    );
  }
});
