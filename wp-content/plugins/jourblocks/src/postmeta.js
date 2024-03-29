const { registerBlockType } = wp.blocks;
const { Fragment } = wp.element;
const {
	RichText,
	BlockControls,
	BlockFormatControls,
	AlignmentToolbar,
	InnerBlocks,
	MediaUpload,
	InspectorControls,
	PanelColor,
	PanelColorSettings,
	withColors,
	PlainText,
} = wp.editor;
const {
	PanelBody,
	PanelRow,
	Button,
	RangeControl,
	Dashicon,
	Tooltip,
	ToggleControl,
	ColorPicker,
	SelectControl,
	TextControl,
	TextareaControl,
} = wp.components;

const { withState } = wp.compose;

registerBlockType("jourblocks/meta-block", {
	title: "Post Meta",
	icon: "smiley",
	category: "common",

	attributes: {
		metaAuthors: {
			type: "string",
			source: "meta",
			meta: "jourblocks_meta_authors",
		},
		metaDate: {
			type: "string",
			source: "meta",
			meta: "jourblocks_meta_date",
		},
		metaIntro: {
			type: "string",
			source: "meta",
			meta: "jourblocks_meta_intro",
		},
		metaHeaderColor: {
			type: "string",
			source: "meta",
			meta: "jourblocks_meta_header-color",
			default: "",
		},
		metaColor: {
			type: "string",
			source: "meta",
			meta: "jourblocks_meta_color",
			default: "",
		},
		metaMedia: {
			type: "string",
			source: "meta",
			meta: "jourblocks_meta_media",
		},
		metaHeader: {
			type: "string",
			source: "meta",
			meta: "jourblocks_meta_header",
			default: "background-img",
		},
	},

	edit({ className, setAttributes, attributes }) {
		function updateMetaDate(metaDate) {
			setAttributes({ metaDate });
		}
		function updateMetaAuthors(metaAuthors) {
			setAttributes({ metaAuthors });
		}
		function updateMetaIntro(metaIntro) {
			setAttributes({ metaIntro });
		}

		function setHeaderColor(metaHeaderColor) {
			setAttributes({ metaHeaderColor });
		}

		function setAccentColor(metaColor) {
			setAttributes({ metaColor });
		}

		const getImageButton = (openEvent) => {
			if (attributes.metaMedia) {
				return (
					<img
						src={attributes.metaMedia}
						onClick={openEvent}
						//className="component__imgcircle"
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
		const MySelectControl = withState({
			size: "50%",
		})(({ size, setState }) => (
			<SelectControl
				label="Choose a header style:"
				value={attributes.metaHeader}
				options={[
					// Mark style as default.
					{
						value: "background-img",
						label: "Line Background Image",
					},
					{
						value: "color-block",
						label: "Color Block",
					},
					{
						value: "half-page",
						label: "Half Page",
					},
					{
						value: "cut-out",
						label: "Cut Out",
					},
				]}
				onChange={(metaHeader) => {
					setAttributes({ metaHeader });
				}}
			/>
		));

		return (
			<Fragment>
				<InspectorControls>
					<PanelBody title="Header Settings" initialOpen={true}>
						<PanelRow>
							<MySelectControl />
						</PanelRow>
						<PanelRow>
							<ColorPicker
								color={attributes.metaHeaderColor}
								onChangeComplete={(value) => setHeaderColor(value.hex)}
								disableAlpha
							/>
						</PanelRow>
						<PanelRow>
							<MediaUpload
								onSelect={(media) => {
									setAttributes({ metaMedia: media.url });
								}}
								type="image"
								value={attributes.metaMedia}
								render={({ open }) => getImageButton(open)}
							/>
						</PanelRow>
					</PanelBody>
					<PanelBody title="Post Settings">
						<PanelRow>
							<ColorPicker
								color={attributes.metaColor}
								onChangeComplete={(value) => setAccentColor(value.hex)}
								disableAlpha
							/>
						</PanelRow>
					</PanelBody>
				</InspectorControls>
				<div>
					<div className={className}>
						<TextControl
							label="Publish Date"
							value={attributes.metaDate}
							onChange={updateMetaDate}
						/>
					</div>
					<div className={className}>
						<TextareaControl
							label="Authors"
							value={attributes.metaAuthors}
							onChange={updateMetaAuthors}
						/>
					</div>
					<div className={className}>
						<TextareaControl
							label="Intro"
							value={attributes.metaIntro}
							onChange={updateMetaIntro}
						/>
					</div>
				</div>
			</Fragment>
		);
	},

	// No information saved to the block
	// Data is saved to post meta via attributes
	save() {
		return null;
	},
});
