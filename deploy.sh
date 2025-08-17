#!/bin/bash

echo "🚀 Railway Deployment Helper for Valentino Rosa Website"
echo "======================================================"
echo ""

# Check if git is configured
if ! git config user.name > /dev/null 2>&1; then
    echo "❌ Git is not configured. Please set up your Git identity first:"
    echo "   git config --global user.name 'Your Name'"
    echo "   git config --global user.email 'your.email@example.com'"
    echo ""
    exit 1
fi

echo "✅ Git is configured"
echo ""

# Check if remote origin exists
if ! git remote get-url origin > /dev/null 2>&1; then
    echo "❌ No GitHub remote configured. Please:"
    echo "   1. Create a new repository on GitHub"
    echo "   2. Run: git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git"
    echo ""
    exit 1
fi

echo "✅ GitHub remote is configured"
echo ""

# Show current status
echo "📊 Current Git Status:"
git status --porcelain | head -10
echo ""

# Ask if user wants to commit and push
read -p "Do you want to commit and push changes to GitHub? (y/n): " -n 1 -r
echo ""

if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "🔄 Committing and pushing changes..."
    
    # Add all changes
    git add .
    
    # Commit
    git commit -m "Update website for Railway deployment - $(date)"
    
    # Push to GitHub
    git push origin main
    
    echo ""
    echo "✅ Changes pushed to GitHub successfully!"
    echo ""
    echo "🚀 Next steps:"
    echo "   1. Go to https://railway.app"
    echo "   2. Sign up with GitHub"
    echo "   3. Create new project from your repository"
    echo "   4. Follow the guide in RAILWAY_DEPLOYMENT.md"
    echo ""
else
    echo "ℹ️  Skipping commit and push. You can do this manually later."
    echo ""
    echo "🚀 To deploy:"
    echo "   1. Push your code to GitHub"
    echo "   2. Go to https://railway.app"
    echo "   3. Follow the guide in RAILWAY_DEPLOYMENT.md"
    echo ""
fi
