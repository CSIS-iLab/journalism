const {
  BlockControls,
  RichText,
  BlockFormatControls,
  MediaUpload,
  PlainText,
  AlignmentToolbar,
  InnerBlocks
} = wp.editor;
const { registerBlockType } = wp.blocks;
const { Button } = wp.components;
const { __ } = wp.i18n;
// Import our CSS files
import "./style.scss";
import "./editor.scss";

registerBlockType("jourblocks/group-img", {
  title: "Image Group",
  icon: "format-gallery",
  category: "common",
  keywords: [
    __("Group", "jourblocks"),
    __("Image", "jourblocks"),
    __("Images", "jourblocks"),
    __("Two", "jourblocks")
  ],
  description: __("Add a block to show two images side by side.", "jourblocks"),
  attributes: {
    align: {
      type: "string",
      default: "full"
    }
  },
  supports: { alignment: ["full"] },
  edit({ attributes, className, setAttributes }) {
    const getImage1Button = openEvent => {
      if (attributes.image1Url) {
        return (
          <img
            src={attributes.image1Url}
            onClick={openEvent}
            className="image"
          />
        );
      } else {
        return (
          <div className="button-container">
            <Button onClick={openEvent} className="button button-large">
              Pick an image
            </Button>
          </div>
        );
      }
    };
    const getImage2Button = openEvent => {
      if (attributes.image2Url) {
        return (
          <img
            src={attributes.image2Url}
            onClick={openEvent}
            className="image"
          />
        );
      } else {
        return (
          <div className="button-container">
            <Button onClick={openEvent} className="button button-large">
              Pick an image
            </Button>
          </div>
        );
      }
    };

    return (
      <div className="group__container">
        <div className="group__img-container">
          <InnerBlocks
            allowedBlocks={["core/image"]}
            template={TEMPLATEA}
            template-lock="all"
          />
        </div>
      </div>
    );
  },

  save({ attributes }) {
    const { alignment } = attributes;
    return (
      <div className="group__container">
        <div className="group__img-container">
          <InnerBlocks.Content />
        </div>
      </div>
    );
  }
});
const TEMPLATEA = [["core/image", {}, []], ["core/image", {}, []]];
