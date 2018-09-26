# Webpack Manifest Bundle

A Symfony bundle enabling support for Webpack Manifests.

This adds two things:

1. A Twig extension allowing to route directly to versioned assets.
2. A Controller serving either the contents of, or, a redirect to the latest version of an asset.

### Controller Support:

Add the following to your routing configuration:
```
_webpackManifestBundleRoutes:
    resource: "@WebpackManifestBundle/Controller"
    type: annotation
```